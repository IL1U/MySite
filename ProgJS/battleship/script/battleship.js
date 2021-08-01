function initTable() {
	const table = document.createElement("table");
	for (let i = 0;i < model.boardSize; i++) {
		let tr = document.createElement("tr");
		for (let j = 0;j < model.boardSize;j++) {
			const td = document.createElement("td");
			td.setAttribute("id", String(i)+String(j));
			td.removeAttribute("class");
			td.setAttribute("onClick", "controler.processGuess(this.id)");
			tr.append(td);
		}
		table.append(tr);
	}
	const messageArea = document.getElementById ("messageArea");
	messageArea.after(table);
	view.displayMessage("Выбирайте цель капитан!");
	model.generateShipLocations();
}

function initNewGame () {
	const answer = confirm("Хотите еще сыграть в Морской бой?");
	for (let i = 0;i < model.boardSize; i++) {
			for (let j = 0;j < model.boardSize;j++) {
				const td = document.getElementById(String(i)+String(j));
				td.removeAttribute("class");
			}
		}
	view.displayMessage("");
	if (answer) {
		for (let i = 0; i < model.numShips; i++) {
			const ship = model.ships[i];
			for (let j = 0; j < model.shipLength; j++) {
				ship.hits[j] = "";
			}
		}
		model.shipsSunk = 0;
		controler.guesses = 0;
		view.displayMessage("Выбирайте цель капитан!");
		model.generateShipLocations();
	} else {
		for (let i = 0;i < model.boardSize; i++) {
			for (let j = 0;j < model.boardSize;j++) {
				const td = document.getElementById(String(i)+String(j));
				td.removeAttribute("onClick");
			}			
		}
		for (let i = 1;i < 6; i++) {
			let msg = 'background: url("img/letter'+i+'.png") no-repeat center center;';
			const td = document.getElementById("2"+i);
			td.setAttribute("style", msg);
			const home = document.createElement("a");
			home.setAttribute("href", "..\\..\\index.php");			
			td.append(home);
		}
	}
}

const view = {
	displayMessage: function (msg) {
		const messageArea = document.getElementById ("messageArea");
		messageArea.innerHTML = msg;
	},
	displayHit: function (location) {
		const cell = document.getElementById (location);
		cell.setAttribute("class", "hit");
	},
	displayMiss: function (location) {
		const cell = document.getElementById (location);
		cell.setAttribute("class", "miss");
	},
};

const model = {
	boardSize: 7,
	numShips: 3,
	shipLength: 3,
	shipsSunk: 0,
	changeNumSunk: false,
	ships: [
		{locations: ["00","00","00"], hits: ["","",""]},
		{locations: ["00","00","00"], hits: ["","",""]},
		{locations: ["00","00","00"], hits: ["","",""]},
	],

	isSunk: function (ship) {
		for (let i = 0; i < this.shipLength; i++) {
			if (ship.hits[i] !== "hit") return false;
		}
		return true;
	},

	isHit: function (guess) {
		this.changeNumSunk = false;
		for (let i = 0; i < this.numShips; i++) {
			const index = this.ships[i].locations.indexOf(guess);
			if (this.ships[i].hits[index] === "hit") return true;
			if (index >= 0) {
				this.ships[i].hits[index] = "hit";
				if (this.isSunk(this.ships[i])) {
					this.shipsSunk++;
					this.changeNumSunk = true;
				}
				return true;
			}
		}
		return false;
	},

	generateShipLocations: function () {
		let locations;
		for (let i = 0; i < this.numShips; i++) {
			do {
				locations = this.generateShip();
			} while (this.collision (locations));
			this.ships[i].locations = locations;
		}
	},

	generateShip: function () {
		const direction = Math.floor(Math.random()*2);
		const posOne = Math.floor(Math.random()*(this.boardSize-this.shipLength));
		const posTwo = Math.floor(Math.random()*this.boardSize);
		let newShipLocation = [];
		for (let i = 0; i < this.shipLength; i++)
			if (direction === 1) {
				newShipLocation.push((posOne+i)+""+posTwo)
			} else newShipLocation.push(posTwo+""+(posOne+i));
		return newShipLocation;
	},

	collision: function (locations) {
		for (let i = 0; i < this.numShips; i++) {
			const ship = this.ships[i];
			for (let j = 0; j < locations.length; j++) {
				if (ship.locations.indexOf(locations[j]) >= 0) return true;
			}
		}
		return false;
	},
};

const controler = {
	guesses: 0,
	isNewGame: false,
	processGuess: function (location) {
		if (this.isNewGame) {
			initNewGame();
			this.isNewGame = false;
			return;
		}
		if (location) {
			this.guesses++;
			if (!model.isHit(location)) {
				view.displayMiss(location);
				view.displayMessage("Вы промахнулись!");
			} else if (!model.changeNumSunk) {
				view.displayHit(location);
				view.displayMessage("Мой корабль ранен!");
			} else if (model.shipsSunk !== model.numShips) {
				view.displayHit(location);
				view.displayMessage("Вы потопили мой корабль!");
			} else {
				view.displayHit(location);
				view.displayMessage("Вы потопили все мои корабли!<br>Всего сделано выстрелов: " + this.guesses);
				this.isNewGame = true;
			}
		}
	},
};

window.onload = initTable;