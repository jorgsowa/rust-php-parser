===source===
<?php for (;;; ) {} while (true) { break; }
===errors===
expected expression, found ';'
missing closing ')'
expected expression, found ')'
expected expression, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting ')' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting ")" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "For": {
          "init": [],
          "condition": [],
          "update": [
            {
              "kind": "Error",
              "span": {
                "start": 13,
                "end": 13
              }
            }
          ],
          "body": {
            "kind": "Nop",
            "span": {
              "start": 13,
              "end": 14
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 15,
        "end": 18
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 18,
        "end": 18
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 27,
              "end": 31
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 35,
                    "end": 41
                  }
                }
              ]
            },
            "span": {
              "start": 33,
              "end": 43
            }
          }
        }
      },
      "span": {
        "start": 20,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
