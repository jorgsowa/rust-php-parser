===source===
<?php abstract class Foo implements Bar, Baz { abstract public function run(): void; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [
            {
              "parts": [
                "Bar"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 36,
                "end": 39,
                "start_line": 1,
                "start_col": 36
              }
            },
            {
              "parts": [
                "Baz"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 41,
                "end": 45,
                "start_line": 1,
                "start_col": 41
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "run",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 79,
                          "end": 83,
                          "start_line": 1,
                          "start_col": 79
                        }
                      }
                    },
                    "span": {
                      "start": 79,
                      "end": 83,
                      "start_line": 1,
                      "start_col": 79
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 85,
                "start_line": 1,
                "start_col": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 86,
        "start_line": 1,
        "start_col": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 86,
    "start_line": 1,
    "start_col": 0
  }
}
