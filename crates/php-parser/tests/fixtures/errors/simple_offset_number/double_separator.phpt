===source===
<?php
"$a[1__2]";
===errors===
invalid offset in simple string interpolation
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '__2' (T_STRING), expecting ']' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected identifier "__2", expecting "]" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 7,
                          "end": 9
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "1__2"
                        },
                        "span": {
                          "start": 10,
                          "end": 14
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 7,
                    "end": 15
                  }
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
