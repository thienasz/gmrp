import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SelectAgencyComponent } from './select-agency/select-agency.component';
import { SelectGameComponent } from './select-game/select-game.component';
import { ReactiveFormsModule } from '@angular/forms';
import { MatInputModule, MatOptionModule, MatFormFieldModule, MatAutocompleteModule, MatSelectModule } from '@angular/material';
import { YearInputComponent } from './year-input/year-input.component';
import { SelectPermissionComponent } from './select-permission/select-permission.component';

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
    YearInputComponent,
    SelectPermissionComponent
  ],
  exports: [
    SelectAgencyComponent,
    SelectGameComponent,
    YearInputComponent
  ]
})
export class FormCustomModule { }
