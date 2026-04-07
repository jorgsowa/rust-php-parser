===config===
min_php=8.5
===source===
<?php (void)$x;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 12,
                  "end": 14
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
