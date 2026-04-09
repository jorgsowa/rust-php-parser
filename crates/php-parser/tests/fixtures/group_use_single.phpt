===source===
<?php use A\B\{C};
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
                  "A",
                  "B",
                  "C"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 16,
                  "start_line": 1,
                  "start_col": 10
                }
              },
              "alias": null,
              "span": {
                "start": 15,
                "end": 16,
                "start_line": 1,
                "start_col": 15
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 18,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18,
    "start_line": 1,
    "start_col": 0
  }
}
