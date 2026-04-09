===source===
<?php class Foo { public function bar(): static {} }
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
                          "static"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 41,
                          "end": 47,
                          "start_line": 1,
                          "start_col": 41
                        }
                      }
                    },
                    "span": {
                      "start": 41,
                      "end": 47,
                      "start_line": 1,
                      "start_col": 41
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 51,
                "start_line": 1,
                "start_col": 18
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 52,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52,
    "start_line": 1,
    "start_col": 0
  }
}
