===source===
<?php for (;;; ) {} while (true) { break; }
===errors===
expected expression
unclosed '')'' opened at Span { start: 10, end: 11 }
expected expression
expected expression
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
                "end": 14
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
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting ")" in Standard input code on line 1
