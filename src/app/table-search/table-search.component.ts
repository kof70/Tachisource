import { Component, OnInit } from '@angular/core';
interface Column {
    field: string;
    header: string;
}

@Component({
  selector: 'app-table-search',
  templateUrl: './table-search.component.html',
  styleUrl: './table-search.component.css'
})
export class TableSearchComponent implements OnInit{
  products!: any[];

    cols!: Column[];

    constructor() {}

    ngOnInit() {
        

        this.cols = [
            { field: 'name', header: 'name' },
            { field: 'Action', header: 'Action' },
            
        ];
    }

    

}
