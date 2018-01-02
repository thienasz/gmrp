import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-setting',
  templateUrl: './setting.component.html',
  styleUrls: ['./setting.component.scss']
})
export class SettingComponent implements OnInit {
  games: any = ["Game a", "Game b", "Game c"];
  agencies: any = ["Agency a", "Agency b", "Agency c"];
  constructor() { }

  ngOnInit() {
  }

}
