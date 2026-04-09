===source===
<?php class Foo { public function name() { return __CLASS__; } }
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
                  "name": "name",
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
                        "Return": {
                          "kind": {
                            "MagicConst": "Class"
                          },
                          "span": {
                            "start": 50,
                            "end": 59,
                            "start_line": 1,
                            "start_col": 50
                          }
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 61,
                        "start_line": 1,
                        "start_col": 43
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 63,
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
        "end": 64,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 64,
    "start_line": 1,
    "start_col": 0
  }
}
