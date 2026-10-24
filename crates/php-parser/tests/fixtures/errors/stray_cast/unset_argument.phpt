===source===
<?php
foo(unset);
===errors===
unexpected token "(unset)"
expected expression, found 'unset'
expected '(', found ')'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(unset)' (unset) (T_UNSET_CAST) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "(unset)" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": "Error",
                      "span": {
                        "start": 10,
                        "end": 10
                      }
                    }
                  },
                  "span": {
                    "start": 10,
                    "end": 10
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 10
          }
        }
      },
      "span": {
        "start": 6,
        "end": 10
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": "Error",
            "span": {
              "start": 15,
              "end": 15
            }
          }
        ]
      },
      "span": {
        "start": 10,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
