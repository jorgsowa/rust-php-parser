===source===
<?php new Foo(new Bar());
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 10,
                  "end": 13
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "Bar"
                          },
                          "span": {
                            "start": 18,
                            "end": 21
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 14,
                      "end": 23
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 14,
                    "end": 23
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
