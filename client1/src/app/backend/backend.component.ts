import { Component, OnInit } from '@angular/core';
import { Router, NavigationStart, NavigationEnd } from '@angular/router';

@Component({
  selector: 'app-backend',
  templateUrl: './backend.component.html',
  styleUrls: ['./backend.component.scss']
})
export class BackendComponent implements OnInit {
  title = 'app';
	globalBodyClass = 'm-page--loading-non-block m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default';

	constructor(private _router: Router) {
	}

	ngOnInit() {
		this._router.events.subscribe((route) => {
			if (route instanceof NavigationStart) {
				// Helpers.setLoading(true);
				// Helpers.bodyClass(this.globalBodyClass);
			}
			if (route instanceof NavigationEnd) {
				// Helpers.setLoading(false);
			}
		});
	}

	public disabled = false;
  public status: {isopen: boolean} = {isopen: false};

  public toggled(open: boolean): void {
    console.log('Dropdown is now: ', open);
  }

  public toggleDropdown($event: MouseEvent): void {
    $event.preventDefault();
    $event.stopPropagation();
    this.status.isopen = !this.status.isopen;
  }

}
