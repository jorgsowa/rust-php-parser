===source===
<?php function gen() { yield; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "gen",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": null,
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 28
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 30
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
