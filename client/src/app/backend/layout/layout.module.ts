import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { SidebarComponent } from './sidebar/sidebar.component';
import { SidebarMinimizeDirective, MobileSidebarToggleDirective } from './sidebar.directive';
import { MaterialModule } from '../../shared/material.module';
import { RouterModule } from '@angular/router';

@NgModule({
  imports: [
    CommonModule,
    MaterialModule,
    RouterModule
  ],
  declarations: [
    HeaderComponent,
    FooterComponent,
    SidebarComponent,
    SidebarMinimizeDirective,
    MobileSidebarToggleDirective
  ],
  exports: [
    HeaderComponent,
    FooterComponent,
    SidebarComponent,
  ]
})
export class LayoutModule { }
