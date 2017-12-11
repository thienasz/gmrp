import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SanPhamComponent } from './san-pham.component';
import { SanPhamRouting } from 'app/containers/san-pham/san-pham-routing.module';
import { SharedModule } from 'app/shared/shared.module';

@NgModule({
  imports: [
    CommonModule,
    SanPhamRouting,
    SharedModule
  ],
  declarations: [SanPhamComponent]
})
export class SanPhamModule { }
