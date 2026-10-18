===source===
<?php foreach ($a as [$x] => $v) {}
===errors===
Can't use this expression in write context
===php_error===
PHP Fatal error:  Cannot use list as key element in Standard input code on line 1
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
          "key": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 22,
                      "end": 24
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 22,
                    "end": 24
                  }
                }
              ]
            },
            "span": {
              "start": 21,
              "end": 25
            }
          },
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 29,
              "end": 31
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 33,
              "end": 35
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
