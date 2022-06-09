<script>
    import { DialogContent, getClose } from "svelte-dialogs";
    import { onMount } from "svelte";
    import base from "./base.js";

    export let table;
    const sendClose = getClose();

    function createEmpty(num) {
        var arr = [];
        for (var i = 0; i < num; i++) {
            arr.push(base.createMatch("",""));
        }
        currentdata.matches = arr;
    }

    let currentdata = {
        white: "",
        red: "",
        matches: [],
        title: "",
    };

    createEmpty(5);

    let teamnumbuer = currentdata.matches.length + "";
    let boardtype = "team";
    let pooltext = "";

    function changeTeamNumber(evt) {
        var n = parseInt(evt.target.value);
        if (typeof n === "number") {
            createEmpty(n);
        }
    }

    function createPool() {
        console.log(pooltext);
        var arr = pooltext.split(/\n/);

        var pl = [];
        for(var i=0; i<arr.length; i++) {
            var name = arr[i].trim();
            if (name) {
                pl.push(name);
            }
        }
        if (pl.length == 2) {
            currentdata.matches = [base.createMatch(pl[0],pl[1])];
        } else if (pl.length == 3) {
            currentdata.matches = [ 
                base.createMatch(pl[0],pl[1]),
                base.createMatch(pl[0],pl[2]),
                base.createMatch(pl[1],pl[2])
            ];
        } else if (pl.length == 4) {
            currentdata.matches = [
                base.createMatch(pl[0],pl[1]),
                base.createMatch(pl[2],pl[1]),
                base.createMatch(pl[2],pl[3]),
                base.createMatch(pl[1],pl[3]),
                base.createMatch(pl[2],pl[0]),
                base.createMatch(pl[3],pl[0])                
            ];
        } else {
            currentdata.matches = [];
            pooltext = "";
        }
        currentdata.red = "";
        currentdata.white = "";
    }

    function Close() {

        if ( boardtype == "pool" ) {
            createPool();
        }

        console.log(currentdata);

        // @ts-ignore
        sendClose(currentdata);
        //sendClose("ok");
    }

    onMount(()=>{
        currentdata = table;
        teamnumbuer = currentdata.matches.length+"";
    });
</script>

<DialogContent>
    <svelte:fragment slot="body">
        <label
            >Board Title
            <input type="text" bind:value={currentdata.title} />
        </label>

        <table style="width: 100%">
            <tr>
                <td
                    ><label
                        >Team <input
                            type="radio"
                            name="boardtype"
                            bind:group={boardtype}
                            value="team"
                        /></label
                    ></td
                >
                <td
                    ><label
                        >Pool <input
                            type="radio"
                            name="boardtype"
                            bind:group={boardtype}
                            value="pool"
                        /></label
                    ></td
                >
                <td
                    ><label
                        >Elimination <input
                            type="radio"
                            name="boardtype"
                            bind:group={boardtype}
                            value="elimination"
                        /></label
                    ></td
                >
            </tr>
        </table>
        {#if boardtype == "team" || boardtype == "elimination"  }
        <table class="tbl1">
            <colgroup>
                <col class="cole"/>
                <col class="colw"/>
                <col class="colr"/>
            </colgroup>
            <thead>
                <tr>
                    <th>
                        <label for="num1">Number</label><br />
                        <select
                            id="num1"
                            bind:value={teamnumbuer}
                            style="width: 5em"
                            on:change={changeTeamNumber}
                        >
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                        </select>
                    </th>
                    <th>
                        <label for="wtn">White Team</label><br />
                        <input id="wtn" type="text" bind:value={currentdata.white} />
                    </th>
                    <th class="rcth"
                        ><label for="rtn">Red Team</label><br />
                        <input id="rtn" type="text" bind:value={currentdata.red} />
                    </th>
                </tr>
            </thead>
            <tbody>
                
                {#each currentdata.matches as m, i}
                    <tr>
                        <th>Player {i + 1}</th>
                        <td class="wpc" ><input type="text" bind:value={m.white.name} /></td>
                        <td class="rpc"><input type="text" bind:value={m.red.name} /></td>
                    </tr>
                {/each}
            </tbody>
        </table>
        {:else if boardtype == "pool"}
        <fieldset class="fs1" >
            <legend>Pool Members</legend>
            <textarea placeholder="Put down to player names here line by line"  bind:value={pooltext} ></textarea>
        </fieldset>
        {/if}
    </svelte:fragment>
    <svelte:fragment slot="footer">
        <button class="btn" on:click={Close}>OK</button>
    </svelte:fragment>
</DialogContent>

<style>
    
    @import "./base.css";

    .tbl1 {
        width: 100%;
        border-collapse: collapse;
    }

    .tbl1 tbody tr:nth-child(even) {
        background-color: rgb(238, 252, 252);
    }
    .tbl1 tbody tr:nth-child(odd) {
        background: rgb(211, 218, 218);
    }

    .tbl1 tbody tr .rpc input {
        background-color: rgb(221, 186, 186);
    }

    .tbl1 thead tr th,
    .tbl1 thead tr td {
        text-align: left;
        height: 2em;
        padding: 3px;
        border: solid 1px black;
    }
    .tbl1 tbody tr th,
    .tbl1 tbody tr td {
        text-align: left;
        vertical-align: middle;
        height: 2em;
        padding: 3px;
        border: solid 1px black;
    }

    .fs1 {        
        text-align: left;
    }

    .fs1 textarea {
        width: 100%;
        resize: none;
        font-size: large;
        height: 6em;
    }
</style>
