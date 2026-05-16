===description===
PHP: (int)((string)$a). Casts stack right-associatively.
===source===
<?php
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
                        "start": 19,
                        "end": 21
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 21
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
