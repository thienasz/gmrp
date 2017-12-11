import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { SanPhamComponent } from 'app/containers/san-pham/san-pham.component';

const routes: Routes = [
  {
    path: '',
    component: SanPhamComponent
  }
];

export const SanPhamRouting: ModuleWithProviders = RouterModule.forChild(routes);
