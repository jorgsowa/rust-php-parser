===source===
<?php
foreach ($a as &[$b]) {}
===errors >=8.5===
expected variable, found array destructuring
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token ")", expecting "->" or "?->" or "{" or "[" in Standard input code on line 2
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token ")", expecting "->" or "?->" or "[" in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 23,
                        "end": 25
                      }
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 25
                  }
                }
              ]
            },
            "span": {
              "start": 22,
              "end": 26
            }
          },
          "by_ref": true,
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 28,
              "end": 30
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
