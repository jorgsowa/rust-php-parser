===source===
<?php

if (true) {
    function A() {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 11,
              "end": 15
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Function": {
                      "name": {
                        "name": "A",
                        "span": {
                          "start": 32,
                          "end": 33
                        }
                      },
                      "params": [],
                      "body": [],
                      "return_type": null,
                      "by_ref": false,
                      "attributes": []
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 38
                  }
                }
              ]
            },
            "span": {
              "start": 17,
              "end": 40
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 7,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
