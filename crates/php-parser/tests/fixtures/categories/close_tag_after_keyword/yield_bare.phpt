===source===
<?php function f() { yield ?>x<?php }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
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
                    "start": 21,
                    "end": 26
                  }
                }
              },
              "span": {
                "start": 21,
                "end": 26
              }
            },
            {
              "kind": {
                "InlineHtml": "x"
              },
              "span": {
                "start": 29,
                "end": 30
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 36,
                "end": 37
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
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
