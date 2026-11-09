===source===
<?php
trait T { abstract function g(); }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 34,
                      "end": 35
                    }
                  },
                  "modifiers": {
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 38
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
