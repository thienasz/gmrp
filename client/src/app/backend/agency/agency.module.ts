import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AgencyRoutingModule } from './agency-routing.module';
import { SharedModule } from '../../shared/shared.module';
import { AgencyComponent } from './agency.component';
import { AgencyService } from './agency.service';
import { NgxChartsModule } from '@swimlane/ngx-charts';
import { FormCustomModule } from '../../components/form-custom/form-custom.module';
import { DialogAgencyForm } from './agency-form/agency-form.component';
import { MAT_DIALOG_DATA } from '@angular/material';

@NgModule({
  imports: [
    CommonModule,
    AgencyRoutingModule,
    SharedModule,
    NgxChartsModule,
    FormCustomModule
  ],
  declarations: [
    AgencyComponent,
    DialogAgencyForm
  ],
  providers: [
    { provide: MAT_DIALOG_DATA, useValue: {} },
  ],
  entryComponents: [
    DialogAgencyForm
  ]
})
export class AgencyModule { }
