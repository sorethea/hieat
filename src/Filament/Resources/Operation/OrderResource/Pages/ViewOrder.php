<?php

namespace Sorethea\Hieat\Filament\Resources\Operation\OrderResource\Pages;

use Sorethea\Hieat\Filament\Resources\Operation\OrderResource;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Traits\DeliveryTrait;
use Carbon\Carbon;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use function App\Filament\Resources\Operation\OrderResource\Pages\auth;
use function App\Filament\Resources\Operation\OrderResource\Pages\trans;
use function PHPUnit\Framework\isNull;

class ViewOrder extends ViewRecord
{
    use DeliveryTrait;
    protected static string $resource = OrderResource::class;

    protected function getActions(): array
    {
        return [
            //Actions\EditAction::make(),
            Actions\Action::make("activate")
                ->label(function(){
                    if($this->record->active) return trans("lang.inactive");
                    else return trans("lang.active");
                })
                ->requiresConfirmation()
                ->action(function (array $data){
                    $this->record->active = !$this->record->active;
                    $this->record->save();
                    $this->redirect($this->record->id);
                })
                ->visible(fn()=>auth()->user()->can("orders.update"))
                ->color("danger"),
            Actions\Action::make("hint")
                ->action(function ( array $data):void{
                    $this->record->hint = $data['hint'];
                    $this->record->updated_at = Carbon::now();
                    $this->record->save();
                    $this->redirect($this->record->id);
                    })
                ->mountUsing(fn (ComponentContainer $form)=>$form->fill(["hint"=>$this->record->hint]))
                ->color('success')
                ->form([
                    MarkdownEditor::make("hint"),
                ]),
            Actions\Action::make("cancel")
                ->color("danger")
                ->requiresConfirmation()
                ->visible(fn():bool=>(($this->record->order_status_id==1||$this->record->order_status_id==2)&&$this->record->active==true))
                ->action(function(){
                    $this->record->active = false;
                    $this->record->updated_at = Carbon::now();
                    $this->record->save();
                    $this->redirect($this->record->id);
                }),
            Actions\Action::make("restore")
                ->color("danger")
                ->requiresConfirmation()
                ->visible(fn():bool=>(auth()->user()->can("orders.restore")&&$this->record->active==false))
                ->action(function(){
                    $this->record->active = true;
                    $this->record->updated_at = Carbon::now();
                    $this->record->save();
                    $this->redirect($this->record->id);
                }),
            Actions\Action::make("assign_driver")
                ->color("primary")
                ->visible(fn()=>empty($this->record->driver_id) && $this->record->active==true && $this->record->order_status_id==2)
                ->form([
                    Select::make("driver")->options($this->getActiveDrivers()),
                ])
                ->action(function (array $data){
                    $this->record->driver_id = $data['driver'];
                    $this->record->updated_at = Carbon::now();
                    $this->record->save();
                    $this->redirect($this->record->id);
                }),
            Actions\Action::make("status")
                ->color("secondary")
                ->visible(fn()=>auth()->user()->can("orders.update"))
                ->form([
                    Select::make("order_status")->options(OrderStatus::pluck('status','id')->toArray()),
                ])
                ->mountUsing(fn (ComponentContainer $form)=>$form->fill(["order_status"=>$this->record->order_status_id]))
                ->action(function (array $data){
                    $this->record->order_status_id = $data['order_status'];
                    $this->record->updated_at = Carbon::now();
                    $this->record->save();
                    $this->redirect($this->record->id);
                }),
        ];
    }
}
