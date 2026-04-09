===source===
<?php enum Status { case Active = ; } function use_status() { return Status::Active; }
===errors===
expected expression
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
                "Case": {
                  "name": "Active",
                  "value": {
                    "kind": "Error",
                    "span": {
                      "start": 34,
                      "end": 35,
                      "start_line": 1,
                      "start_col": 34
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 36,
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
        "end": 37,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Function": {
          "name": "use_status",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "ClassConstAccess": {
                      "class": {
                        "kind": {
                          "Identifier": "Status"
                        },
                        "span": {
                          "start": 69,
                          "end": 75,
                          "start_line": 1,
                          "start_col": 69
                        }
                      },
                      "member": "Active"
                    }
                  },
                  "span": {
                    "start": 69,
                    "end": 83,
                    "start_line": 1,
                    "start_col": 69
                  }
                }
              },
              "span": {
                "start": 62,
                "end": 85,
                "start_line": 1,
                "start_col": 62
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 38,
        "end": 86,
        "start_line": 1,
        "start_col": 38
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
