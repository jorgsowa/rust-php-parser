===source===
<?php enum E { case A; public function f() { ?> <?php } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "E",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "A",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 15,
                "end": 23
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "f",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "InlineHtml": " "
                      },
                      "span": {
                        "start": 47,
                        "end": 48
                      }
                    },
                    {
                      "kind": "Nop",
                      "span": {
                        "start": 54,
                        "end": 55
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 56
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}
