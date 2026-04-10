===source===
<?php class Foo { public function bar(): self {} }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "bar",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 41,
                          "end": 45
                        }
                      }
                    },
                    "span": {
                      "start": 41,
                      "end": 45
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 48
              }
            }
          ],
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
