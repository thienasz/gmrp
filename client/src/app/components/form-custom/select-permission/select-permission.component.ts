import { Component, OnInit, Input, EventEmitter, Output } from '@angular/core';
import { FormControl } from '@angular/forms';
import { GameService } from '../../../backend/game/game.service';
import { FormGroup } from '@angular/forms/src/model';

@Component({
  selector: 'app-select-permission',
  templateUrl: './select-permission.component.html',
  styleUrls: ['./select-permission.component.scss']
})
export class SelectPermissionComponent implements OnInit {
  @Input() permission: FormControl = new FormControl();
  @Output() change: EventEmitter<any> = new EventEmitter<any>();
  permissionTemp: FormControl;

  permissions: any;

  constructor(
    private gameService: GameService,
  ) { }

  ngOnInit() {
    this.permissionTemp = new FormControl('', this.permission.validator);
    this.gameService.getGames().subscribe(
      (req) => {
        console.log(req);
        this.permissions = req.data;
      });
  }

  onChange($event, selected) {
    if ($event.isUserInput) {
      console.log(selected);
      this.permission.setValue(selected.id);
      this.change.emit(selected);
    }
  }

}
