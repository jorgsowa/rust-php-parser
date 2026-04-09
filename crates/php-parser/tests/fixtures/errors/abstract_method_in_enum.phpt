===source===
<?php enum Status { abstract public function label(): string; }
===errors===
enum methods cannot be abstract
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "label",
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
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 54,
                          "end": 60,
                          "start_line": 1,
                          "start_col": 54
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 60,
                      "start_line": 1,
                      "start_col": 54
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 62,
                "start_line": 1,
                "start_col": 20
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63,
    "start_line": 1,
    "start_col": 0
  }
}
