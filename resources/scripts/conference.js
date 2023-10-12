import { wrapGrid } from 'animate-css-grid'

export default {
    init() {
        const grid = document.querySelector(".conference-panels");
        wrapGrid(grid);
    }
}