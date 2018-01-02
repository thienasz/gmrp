import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { GameRoutingModule } from './game-routing.module';
import { SharedModule } from '../../shared/shared.module';
import { ReactiveFormsModule } from '@angular/forms';
import { MaterialModule } from '../../shared/material.module';
import { DialogGameForm } from './game-form/game-form.component';
import { GameComponent } from './game.component';

@NgModule({
  imports: [
    CommonModule,
    GameRoutingModule,
    SharedModule,
    ReactiveFormsModule,
    MaterialModule
  ],
  declarations: [
    DialogGameForm,
    GameComponent
  ],
  entryComponents:[ DialogGameForm ]
})
export class GameModule { }
