===source===
<?php
// PHP: (int)((string)$a). Casts stack right-associatively.
(int)(string)$a;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Int",
              {
                "kind": {
                  "Cast": [
                    "String",
                    {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 79,
                        "end": 81
                      }
                    }
                  ]
                },
                "span": {
                  "start": 71,
                  "end": 81
                }
              }
            ]
          },
          "span": {
            "start": 66,
            "end": 81
          }
        }
      },
      "span": {
        "start": 66,
        "end": 82
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 82
  }
}
