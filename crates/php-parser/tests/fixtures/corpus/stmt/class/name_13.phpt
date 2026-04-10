===source===
<?php interface A extends self {}
===errors===
cannot use 'self' as class name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "A",
          "extends": [
            {
              "parts": [
                "self"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 26,
                "end": 30
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
