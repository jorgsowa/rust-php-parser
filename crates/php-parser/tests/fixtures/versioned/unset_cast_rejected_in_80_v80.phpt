===config===
min_php=8.0
===source===
<?php (unset)$x;
===errors===
the (unset) cast is no longer supported
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Unset",
              {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 13,
                  "end": 15
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
