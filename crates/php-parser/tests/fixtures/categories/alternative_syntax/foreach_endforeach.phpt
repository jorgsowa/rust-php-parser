===source===
<?php foreach ($arr as $v): echo $v; endforeach;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "arr"
            },
            "span": {
              "start": 15,
              "end": 19
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 23,
              "end": 25
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
                          "Variable": "v"
                        },
                        "span": {
                          "start": 33,
                          "end": 35
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 28,
                    "end": 37
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 48
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
