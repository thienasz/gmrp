import { RouterModule } from '@angular/router';
import { PIPES } from './pipes/index';
import { COMPONENTS } from './components/index';
import { NgModule, ModuleWithProviders } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SERVICES } from './services/index';
import { LoadingComponent } from './components/loading/loading.component';
import {SlimLoadingBarModule} from 'ng2-slim-loading-bar';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';


@NgModule({
  imports: [
    CommonModule,
    SlimLoadingBarModule.forRoot(),
    RouterModule,
    FormsModule,
    ReactiveFormsModule
  ],
  declarations: [
    ...COMPONENTS,
    ...PIPES,
    LoadingComponent
  ],
  exports: [
    CommonModule,
    SlimLoadingBarModule,
    ...COMPONENTS,
    ...PIPES
  ]
})
export class SharedModule {
  static forRoot(): ModuleWithProviders {
    return {
      ngModule: SharedModule,
      providers: [
        ...SERVICES
      ]
    };
  }
}
