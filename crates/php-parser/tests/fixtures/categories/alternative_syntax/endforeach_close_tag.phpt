===source===
<?php foreach ($xs as $x): ?><?= $x ?><?php endforeach ?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "xs"
            },
            "span": {
              "start": 15,
              "end": 18
            }
          },
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
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 33,
                          "end": 35
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 33,
                    "end": 35
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 54
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
