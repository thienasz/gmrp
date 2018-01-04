import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BsDropdownModule } from 'ngx-bootstrap/dropdown';
import { ModalModule } from 'ngx-bootstrap/modal';
import { TabsModule } from 'ngx-bootstrap/tabs';
import { PaginationModule } from 'ngx-bootstrap/pagination';
import { ChartsModule } from 'ng2-charts/ng2-charts';
import { BackendRoutingModule } from './backend-routing.module';
import { BackendComponent } from './backend.component';
import { UserComponent } from './user/user.component';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { DashboardComponent } from './dashboard/dashboard.component';
import { AsideToggleDirective } from '../shared/aside.directive';
import { SIDEBAR_TOGGLE_DIRECTIVES } from '../shared/sidebar.directive';
import { BreadcrumbsComponent } from '../shared/breadcrumb.component';
import { NAV_DROPDOWN_DIRECTIVES } from '../shared/nav-dropdown.directive';
import { GameComponent } from './game/game.component';
import { MaterialModule } from '../shared/material.module';
import { AppInterceptor } from './services/interceptor.service';
import { GameService } from './services/game.service';
import { UserService } from './services/user.service';
import { ReportService } from './services/report.service';
import { AgencyService } from './services/agency.service';
import { AgencyComponent } from './agency/agency.component';

@NgModule({
  imports: [
    CommonModule,
    ReactiveFormsModule,
    BackendRoutingModule,
    HttpClientModule,
    BsDropdownModule.forRoot(),
    TabsModule.forRoot(),
    ChartsModule,
    ModalModule.forRoot(),
    MaterialModule,
    PaginationModule.forRoot()
  ],
  declarations: [
    NAV_DROPDOWN_DIRECTIVES,
    BreadcrumbsComponent,
    SIDEBAR_TOGGLE_DIRECTIVES,
    AsideToggleDirective,
    BackendComponent, 
    UserComponent, 
    DashboardComponent,
    GameComponent,
    AgencyComponent
  ],
  providers: [
    { provide: HTTP_INTERCEPTORS, useClass: AppInterceptor, multi: true },
    GameService,
    UserService,
    ReportService,
    AgencyService
  ]
})
export class BackendModule { }
