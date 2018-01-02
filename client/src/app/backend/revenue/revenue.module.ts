import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { RevenueRoutingModule } from './revenue-routing.module';
import { SharedModule } from '../../shared/shared.module';
import { NgxChartsModule } from '@swimlane/ngx-charts';
import { RevenueService } from './revenue.service';
import { AgencyComponent } from '../agency/agency.component';
import { RevenueComponent } from './revenue.component';
import { FormCustomModule } from '../../components/form-custom/form-custom.module';

@NgModule({
  imports: [
    CommonModule,
    RevenueRoutingModule,
    SharedModule,
    NgxChartsModule,
    FormCustomModule
  ],
  declarations: [
    RevenueComponent
  ],
  providers: [
  ]
})
export class RevenueModule { }
