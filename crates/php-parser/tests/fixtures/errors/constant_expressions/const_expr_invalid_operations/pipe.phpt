===source===
<?php
const I = 1 |> B;
===errors <=8.4===
'pipe operator (|>)' requires PHP 8.5 or higher
Constant expression contains invalid operations
===errors >=8.5===
Constant expression contains invalid operations
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '>' in Standard input code on line 2
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token ">" in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "I",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  },
                  "op": "Pipe",
                  "right": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "B"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 21,
                          "end": 22
                        }
                      }
                    },
                    "span": {
                      "start": 21,
                      "end": 22
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 22
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 22
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
