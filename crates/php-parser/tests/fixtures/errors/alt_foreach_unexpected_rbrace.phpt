===source===
<?php foreach ($a as $b):
    echo $b;
} endforeach;
===errors===
expected expression, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  Unmatched '}' in Standard input code on line 3
===ast===
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
              "Variable": "b"
            },
            "span": {
              "start": 21,
              "end": 23
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 35,
                          "end": 37
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 30,
                    "end": 38
                  }
                },
                {
                  "kind": "Error",
                  "span": {
                    "start": 39,
                    "end": 38
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 52
            }
          },
          "uses_alternative": true
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
