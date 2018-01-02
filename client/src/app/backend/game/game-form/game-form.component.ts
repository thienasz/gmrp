import { Component, OnInit, Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { GameService } from '../game.service';

@Component({
    selector: 'dialog-game-form',
    templateUrl: 'game-form.component.html',
})
export class DialogGameForm implements OnInit {
    gameForm: FormGroup;
    game: any = {
        name: "",
        description: ""
    }

    ngOnInit(): void {
        this.gameForm = this.fb.group({
            name: [this.game.name, Validators.required],
            description: [this.game.description, Validators.required]
        })
    }

    constructor(
        public dialogRef: MatDialogRef<DialogGameForm>,
        @Inject(MAT_DIALOG_DATA) public data: any,
        private fb: FormBuilder,
        private gameService: GameService,
    ) { 
        if(data) {
            this.game = data;
        }
    }

    onSubmit() {
        if(this.gameForm.valid) {
            this.gameService.postGame(this.gameForm.value).subscribe(
                (req) => {
                    this.dialogRef.close();
                }
            )
        }
    }

    onNoClick(): void {
        this.dialogRef.close();
    }
}