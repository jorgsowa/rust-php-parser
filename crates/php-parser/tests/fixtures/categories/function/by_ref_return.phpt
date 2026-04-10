===source===
<?php function &getRef() { global $x; return $x; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "getRef",
          "params": [],
          "body": [
            {
              "kind": {
                "Global": [
                  {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 34,
                      "end": 36
                    }
                  }
                ]
              },
              "span": {
                "start": 27,
                "end": 37
              }
            },
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 45,
                    "end": 47
                  }
                }
              },
              "span": {
                "start": 38,
                "end": 48
              }
            }
          ],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
