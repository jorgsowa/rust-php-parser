===source===
<?php use;
===errors===
expected identifier, found ';'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "<error>"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 9,
                  "end": 9,
                  "start_line": 1,
                  "start_col": 9
                }
              },
              "alias": null,
              "span": {
                "start": 9,
                "end": 9,
                "start_line": 1,
                "start_col": 9
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 10,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 10,
    "start_line": 1,
    "start_col": 0
  }
}
