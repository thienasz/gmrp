import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SelectAgencyComponent } from './select-agency/select-agency.component';
import { SelectGameComponent } from './select-game/select-game.component';
import { ReactiveFormsModule } from '@angular/forms';
import { MatInputModule, MatOptionModule, MatFormFieldModule, MatAutocompleteModule, MatSelectModule } from '@angular/material';
import { YearInputComponent } from './year-input/year-input.component';

@NgModule({
  imports: [
    CommonModule,
    ReactiveFormsModule,
    MatInputModule,
    MatOptionModule,
    MatFormFieldModule,
    MatAutocompleteModule,
    MatSelectModule
  ],
  declarations: [
    SelectAgencyComponent,
    SelectGameComponent,
    YearInputComponent
  ],
  exports: [
    SelectAgencyComponent,
    SelectGameComponent,
    YearInputComponent
  ]
})
export class FormCustomModule { }
