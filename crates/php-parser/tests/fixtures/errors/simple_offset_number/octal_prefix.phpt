===source===
<?php
"$a[0o7]";
===errors <=8.0===
invalid offset in simple string interpolation
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'o7' (T_STRING), expecting ']' in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "o7", expecting "]" in Standard input code on line 2
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
                          "String": "0o7"
                        },
                        "span": {
                          "start": 10,
                          "end": 13
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 7,
                    "end": 14
                  }
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
