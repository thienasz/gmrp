import { Component, OnInit, Input, EventEmitter, Output } from '@angular/core';
import { FormControl } from '@angular/forms';
import { GameService } from '../../../backend/game/game.service';
import { FormGroup } from '@angular/forms/src/model';

@Component({
  selector: 'app-select-game',
  templateUrl: './select-game.component.html',
  styleUrls: ['./select-game.component.scss']
})
export class SelectGameComponent implements OnInit {
  @Input() game: FormControl = new FormControl();
  @Output() change: EventEmitter<any> = new EventEmitter<any>();
  gameTem: FormControl;

  games: any;

  constructor(
    private gameService: GameService,
  ) { }

  ngOnInit() {
    console.log("init gm s");
    this.gameTem = new FormControl('', this.game.validator);
    this.gameService.getGames().subscribe(
      (req) => {
        console.log(req);
        this.games = req.data;
      }
    )
  }

  onChange($event, selected) {
    if($event.isUserInput) {
      console.log(selected);
      this.game.setValue(selected.id);
      this.change.emit(selected);
    }
  }
}
