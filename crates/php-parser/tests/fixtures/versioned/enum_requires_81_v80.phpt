===config===
parse_version=8.0
===source===
<?php enum Status { case Active; case Inactive; }
===errors===
'enums' requires PHP 8.1 or higher (targeting PHP 8.0)
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
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 32
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Inactive",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
