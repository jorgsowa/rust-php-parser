===source===
<?php #[\App\Attr] function foo() {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "App",
                  "Attr"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 8,
                  "end": 17
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 17
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
