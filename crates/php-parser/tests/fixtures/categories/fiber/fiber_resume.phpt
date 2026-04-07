===config===
min_php=8.1
===source===
<?php $fiber->resume('world');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "fiber"
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "method": {
                "kind": {
                  "Identifier": "resume"
                },
                "span": {
                  "start": 14,
                  "end": 20
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "String": "world"
                    },
                    "span": {
                      "start": 21,
                      "end": 28
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 21,
                    "end": 28
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 29
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
