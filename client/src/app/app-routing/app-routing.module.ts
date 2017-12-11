import { CustomPreloader } from './custom.preloader';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { MainLayoutComponent } from 'app/shared/components/main-layout/main-layout.component';

const routes: Routes = [
  {
    path: '',
    component: MainLayoutComponent,
    children: [
      {
        path: '',
        loadChildren: 'app/containers/home/home.module#HomeModule',
        data: {
          preload: true
        }
      },
      {
        path: 'home',
        loadChildren: 'app/containers/home/home.module#HomeModule',
        data: {
          preload: true
        }
      },
      {
        path: 'san-pham',
        loadChildren: 'app/containers/san-pham/san-pham.module#SanPhamModule',
        data: {
          preload: true
        }
      },
      {
        path: 'login',
        loadChildren: 'app/containers/login/login.module#LoginModule',
        data: {
          preload: true
        }
      },
    ]
  },
  {
    path: 'error',
    loadChildren: 'app/containers/error/error.module#ErrorModule',
    data: {
      preload: true
    }
  },
  {
    path: '**',
    redirectTo: '/error/404'
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes, { useHash: true, preloadingStrategy: CustomPreloader })],
  exports: [RouterModule],
  providers: [CustomPreloader]
})
export class AppRoutingModule { }
