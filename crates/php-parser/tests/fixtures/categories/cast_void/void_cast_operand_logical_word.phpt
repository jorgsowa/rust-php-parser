===source===
<?php
(void) $a or $b;
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected variable "$a" in Standard input code on line 2
===ast >=8.5===
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 13,
                        "end": 15
                      }
                    },
                    "op": "LogicalOr",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 19,
                        "end": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 13,
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
