import {NgModule} from '@angular/core';
import { HeaderNavComponent } from './header-nav/header-nav.component';
import { AsideNavComponent } from './aside-nav/aside-nav.component';
import { FooterComponent } from './footer/footer.component';
import {CommonModule} from '@angular/common';
import {RouterModule} from '@angular/router';
import { HrefPreventDefaultDirective } from '../directives/href-prevent-default.directive';
import { UnwrapTagDirective } from '../directives/unwrap-tag.directive';

@NgModule({
	declarations: [
		// LayoutComponent,
		// AsideLeftMinimizeDefaultEnabledComponent,
		HeaderNavComponent,
		AsideNavComponent,
		FooterComponent,
		// QuickSidebarComponent,
		// ScrollTopComponent,
		// TooltipsComponent,
		// HrefPreventDefaultDirective,
		// UnwrapTagDirective,
	],
	exports: [
		// LayoutComponent,
		// AsideLeftMinimizeDefaultEnabledComponent,
		HeaderNavComponent,
		// DefaultComponent,
		AsideNavComponent,
		FooterComponent,
		// QuickSidebarComponent,
		// ScrollTopComponent,
		// TooltipsComponent,
		// HrefPreventDefaultDirective,
	],
	imports: [
		CommonModule,
		RouterModule,
	]
})
export class LayoutModule {
}